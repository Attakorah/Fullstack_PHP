const PAYSTACK_PUBLIC_KEY = "pk_test_ff149870f07069255aab86d1148231fdba18be6c";
const CURRENCY = "GHS";

const products = [
  {
    id: "samsung-tv",
    name: "Samsung TV",
    category: "Display",
    description: "A clean smart TV setup for movies, gaming, and streaming at home.",
    price: 4800,
    image: "Project Files/Images/product1.png",
  },
  {
    id: "pixel-4a",
    name: "Pixel 4a",
    category: "Phone",
    description: "A compact Android phone with a sharp camera and smooth everyday performance.",
    price: 2400,
    image: "Project Files/Images/product2.png",
  },
  {
    id: "ps-5",
    name: "PS 5",
    category: "Gaming",
    description: "A next-generation PlayStation console for immersive gaming and entertainment.",
    price: 6900,
    image: "Project Files/Images/product3.png",
  },
  {
    id: "macbook-air",
    name: "Macbook Air",
    category: "Laptop",
    description: "A lightweight laptop for school, work, design, browsing, and productivity.",
    price: 8500,
    image: "Project Files/Images/product4.png",
  },
  {
    id: "apple-watch",
    name: "Apple Watch",
    category: "Wearable",
    description: "A smartwatch for fitness tracking, notifications, calls, and daily planning.",
    price: 3300,
    image: "Project Files/Images/product5.png",
  },
  {
    id: "air-pods",
    name: "Air Pods",
    category: "Audio",
    description: "Wireless earbuds for calls, music, podcasts, and travel-friendly listening.",
    price: 1200,
    image: "Project Files/Images/product6.png",
  },
];

const productButtons = document.querySelectorAll("[data-add-to-cart]");
const cartPanel = document.querySelector("[data-cart-panel]");
const cartItems = document.querySelector("[data-cart-items]");
const cartCount = document.querySelector("[data-cart-count]");
const cartTotal = document.querySelector("[data-cart-total]");
const cartOverlay = document.querySelector("[data-cart-overlay]");
const checkoutForm = document.querySelector("[data-checkout-form]");
const cartNote = document.querySelector("[data-cart-note]");
const userFields = document.querySelectorAll("[data-user-field]");
const summaryModal = document.querySelector("[data-summary-modal]");
const summaryMessage = document.querySelector("[data-summary-message]");
const summaryItems = document.querySelector("[data-summary-items]");
const summaryOkButton = document.querySelector("[data-summary-ok]");

let cart = loadSavedCart().filter((savedProduct) =>
  products.some((product) => product.id === savedProduct.id)
).map((savedProduct) => ({
  ...products.find((product) => product.id === savedProduct.id),
  quantity: savedProduct.quantity || 1,
}));
let user = loadSavedUser();

function formatMoney(amount) {
  return new Intl.NumberFormat("en-GH", {
    style: "currency",
    currency: CURRENCY,
    maximumFractionDigits: 0,
  }).format(amount);
}

function saveCart() {
  saveCartItems(cart);
}

function saveUser() {
  saveUserDetails(user);
}

function getCartTotal() {
  return cart.reduce((total, product) => total + product.price * product.quantity, 0);
}

function updateCartBadge() {
  cartCount.textContent = cart.length;
}

function updateCartTotal() {
  cartTotal.textContent = formatMoney(getCartTotal());
}

function updateCheckoutButton() {
  checkoutForm.querySelector(".pay-button").disabled = !cart.length;
}

function isProductInCart(productId) {
  return cart.some((product) => product.id === productId);
}

function updateProductButtons() {
  productButtons.forEach((button) => {
    const productId = button.dataset.addToCart;
    const selected = isProductInCart(productId);

    button.textContent = selected ? "Remove from Cart" : "Add to Cart";
    button.classList.toggle("is-selected", selected);
    button.setAttribute("aria-pressed", String(selected));
  });
}

function getUserFromForm() {
  const formData = new FormData(checkoutForm);

  return {
    name: formData.get("name").trim(),
    email: formData.get("email").trim(),
    phone: formData.get("phone").trim(),
  };
}

function showFieldError(fieldName, message) {
  const field = checkoutForm.elements[fieldName];
  const error = document.querySelector(`[data-error-for="${fieldName}"]`);

  field.classList.toggle("has-error", Boolean(message));
  field.setAttribute("aria-invalid", String(Boolean(message)));
  error.textContent = message;
}

function validateField(field) {
  const fieldName = field.name;
  const value = field.value.trim();
  let message = "";

  if (!value) {
    message = "This field is required.";
  } else if (fieldName === "email" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
    message = "Enter a valid email address.";
  } else if (fieldName === "phone") {
    const digitsOnly = value.replace(/\D/g, "");

    if (!/^\+?[\d\s-]+$/.test(value)) {
      message = "Use only numbers, spaces, hyphens, or a leading plus.";
    } else if (digitsOnly.length < 10 || digitsOnly.length > 15) {
      message = "Phone number must be 10 to 15 digits.";
    }
  }

  showFieldError(fieldName, message);
  return !message;
}

function validateUserDetails() {
  const validationResults = Array.from(userFields).map((field) => validateField(field));
  return validationResults.every(Boolean);
}

function populateUserDetails() {
  userFields.forEach((field) => {
    if (user[field.name]) {
      field.value = user[field.name];
    }
  });
}

function createEmptyCartMessage() {
  return '<div class="empty-cart">Your cart is empty.<br>Add a gadget to get started.</div>';
}

function createCartItem(product) {
  const itemTotal = product.price * product.quantity;
  const cartItem = document.createElement("article");

  cartItem.className = "cart-item";
  cartItem.innerHTML = `
    <img src="${product.image}" alt="${product.name}">
    <div>
      <h3>${product.name}</h3>
      <p>${formatMoney(itemTotal)} <span>(${formatMoney(product.price)} each)</span></p>
      <div class="cart-item-controls">
        <div class="quantity-control" aria-label="Quantity controls for ${product.name}">
          <button type="button" aria-label="Reduce ${product.name}" data-decrease="${product.id}">
            <i data-lucide="minus"></i>
          </button>
          <span>${product.quantity}</span>
          <button type="button" aria-label="Increase ${product.name}" data-increase="${product.id}">
            <i data-lucide="plus"></i>
          </button>
        </div>
        <button class="remove-button" type="button" data-remove="${product.id}">Remove</button>
      </div>
    </div>
  `;

  return cartItem;
}

function renderCartItems() {
  cartItems.innerHTML = "";

  if (!cart.length) {
    cartItems.innerHTML = createEmptyCartMessage();
    return;
  }

  cart.forEach((product) => {
    cartItems.appendChild(createCartItem(product));
  });
}

function renderCart() {
  renderCartItems();
  updateCartBadge();
  updateCartTotal();
  updateCheckoutButton();
  updateProductButtons();
  refreshIcons();
}

function toggleCartProduct(productId) {
  const selectedProduct = products.find((product) => product.id === productId);

  if (!selectedProduct) {
    return;
  }

  if (isProductInCart(productId)) {
    cart = cart.filter((product) => product.id !== productId);
  } else {
    cart.push({ ...selectedProduct, quantity: 1 });
  }

  saveCart();
  renderCart();
  openCart();
}

function updateQuantity(productId, direction) {
  cart = cart
    .map((product) => {
      if (product.id !== productId) {
        return product;
      }

      return { ...product, quantity: product.quantity + direction };
    })
    .filter((product) => product.quantity > 0);

  saveCart();
  renderCart();
}

function removeFromCart(productId) {
  cart = cart.filter((product) => product.id !== productId);
  saveCart();
  renderCart();
}

function openCart() {
  document.body.classList.add("cart-open");
  cartPanel.setAttribute("aria-hidden", "false");
}

function closeCart() {
  document.body.classList.remove("cart-open");
  cartPanel.setAttribute("aria-hidden", "true");
}

function openSummaryModal(purchase) {
  summaryMessage.textContent = `Thank you, ${purchase.customer.name}. Your purchase was successful.`;
  summaryItems.innerHTML = purchase.items
    .map((product) => `
      <article class="summary-item">
        <span>${product.name}</span>
        <strong>x${product.quantity}</strong>
      </article>
    `)
    .join("");

  document.body.classList.add("summary-open");
  summaryModal.setAttribute("aria-hidden", "false");
  refreshIcons();
}

function resetPurchaseData() {
  cart = [];
  user = {};
  clearCheckoutData();
}

function closeSummaryAndReset() {
  resetPurchaseData();
  window.location.reload();
}

function getPaystackBlocker() {
  const total = getCartTotal();

  if (!total) {
    return "Add at least one gadget before checking out.";
  }

  if (PAYSTACK_PUBLIC_KEY.includes("xxxxxxxx")) {
    return "Replace PAYSTACK_PUBLIC_KEY in script.js with your real Paystack test public key.";
  }

  if (typeof PaystackPop === "undefined" && typeof Paystack === "undefined") {
    return "Paystack could not load. Check your internet connection and try again.";
  }

  return "";
}

function createPurchaseSnapshot(customer) {
  return {
    customer,
    items: cart.map((product) => ({ ...product })),
  };
}

function startPaystackCheckout(customer) {
  const total = getCartTotal();
  const purchase = createPurchaseSnapshot(customer);
  const paystackHandler = window.PaystackPop || window.Paystack;

  const handler = paystackHandler.setup({
    key: PAYSTACK_PUBLIC_KEY,
    email: customer.email,
    amount: total * 100,
    currency: CURRENCY,
    metadata: {
      custom_fields: [
        {
          display_name: "Customer Name",
          variable_name: "customer_name",
          value: customer.name,
        },
        {
          display_name: "Phone Number",
          variable_name: "phone_number",
          value: customer.phone,
        },
        {
          display_name: "Cart Items",
          variable_name: "cart_items",
          value: cart.map((product) => `${product.name} x${product.quantity}`).join(", "),
        },
      ],
    },
    callback: (response) => {
      cart = [];
      saveCart();
      renderCart();
      cartNote.textContent = `Payment successful. Reference: ${response.reference}`;
      openSummaryModal(purchase);
    },
    onClose: () => {
      cartNote.textContent = "Payment cancelled. Your cart is still saved.";
    },
  });

  handler.openIframe();
}

function canLaunchPaystack() {
  const blocker = getPaystackBlocker();

  if (blocker) {
    cartNote.textContent = blocker;
    return false;
  }

  return true;
}

function refreshIcons() {
  if (window.lucide) {
    lucide.createIcons();
  }
}

productButtons.forEach((button) => {
  button.addEventListener("click", () => {
    toggleCartProduct(button.dataset.addToCart);
  });
});

userFields.forEach((field) => {
  field.addEventListener("blur", () => {
    validateField(field);
    user = getUserFromForm();
    saveUser();
  });
});

document.querySelectorAll("[data-open-cart]").forEach((button) => {
  button.addEventListener("click", openCart);
});

document.querySelectorAll("[data-close-cart]").forEach((button) => {
  button.addEventListener("click", closeCart);
});
cartOverlay.addEventListener("click", closeCart);
summaryOkButton.addEventListener("click", closeSummaryAndReset);

cartItems.addEventListener("click", (event) => {
  const decreaseButton = event.target.closest("[data-decrease]");
  const increaseButton = event.target.closest("[data-increase]");
  const removeButton = event.target.closest("[data-remove]");

  if (decreaseButton) {
    updateQuantity(decreaseButton.dataset.decrease, -1);
  }

  if (increaseButton) {
    updateQuantity(increaseButton.dataset.increase, 1);
  }

  if (removeButton) {
    removeFromCart(removeButton.dataset.remove);
  }
});

checkoutForm.addEventListener("submit", (event) => {
  event.preventDefault();

  if (!validateUserDetails()) {
    cartNote.textContent = "Please correct your details before checking out.";
    return;
  }

  user = getUserFromForm();
  saveUser();

  if (!canLaunchPaystack()) {
    return;
  }

  closeCart();
  startPaystackCheckout(user);
});

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    closeCart();
  }
});

populateUserDetails();
renderCart();
refreshIcons();
