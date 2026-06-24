const EMS_CART_KEY = "emsCart";
const EMS_USER_KEY = "emsUser";

function loadSavedCart() {
  try {
    const savedCart = JSON.parse(localStorage.getItem(EMS_CART_KEY));
    return Array.isArray(savedCart) ? savedCart : [];
  } catch {
    return [];
  }
}

function saveCartItems(cartItems) {
  localStorage.setItem(EMS_CART_KEY, JSON.stringify(cartItems));
}

function loadSavedUser() {
  try {
    const savedUser = JSON.parse(localStorage.getItem(EMS_USER_KEY));
    return savedUser && typeof savedUser === "object" ? savedUser : {};
  } catch {
    return {};
  }
}

function saveUserDetails(user) {
  localStorage.setItem(EMS_USER_KEY, JSON.stringify(user));
}

function clearCheckoutData() {
  localStorage.removeItem(EMS_CART_KEY);
  localStorage.removeItem(EMS_USER_KEY);
}
