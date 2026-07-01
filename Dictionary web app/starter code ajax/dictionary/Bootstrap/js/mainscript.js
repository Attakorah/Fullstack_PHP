function submitSearchAjax() {
	var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function(){
		//console.log(this.responseText);
		if (this.readyState === 4 && this.status === 200) {
			var result = JSON.parse(this.responseTest);
			if (result.success=="true") {
				document.getElementById('search').value = result.nameOfWord;
				document.getElementById('searchResult').innerHTML = '<div class="row">'+
																		'<div class="col-md-8 col-sm-8">'+
																			'<p style="color:maroon;font-size:18px">'+result.searchResult+'</p>'+
																		'</div>'+
																		'<div class ="col-md-4 col-sm-4">'+
																			'<form>'+
																			'<div class="col-md-12 col-sm-12">'+
																				'<div class="form-group">'+
																					'<button type="button" name="update" class="btn btn-primary btn-md" id="submitUpdate">'+'Update'+
																					'</button>'+
																					'<button type="button" name="delete" class="btn btn-primary btn-md" id="submitDelete">'+'Delete'+
																					'</button>'+
																				'</div>'+
																			'</div>'+																				
																			'</form>'+
																		'</div>'+
																	'</div>';
				document.getElementById("searchResult").style.display="block";
				document.getElementById("searchImage").style.display="none";
				document.getElementById("searchMessage").innerHTML="";
				document.getElementById("searchMessage").style.display="none";
			} else if(result.failure=="false"){
				document.getElementById("searchImage").style.display="none";
				document.getElementById("searchMessage").innerHTML='<strong>Danger!</strong>'+result.noResult;
				document.getElementById("searchMessage").style.display="block";
				document.getElementById("searchResult").style.display="none";
				document.getElementById("searchResult").innerHTML="";
			}else{
				document.getElementById("searchMessage").style.display="none";
				document.getElementById("searchMessage").innerHTML="";
				document.getElementById("searchResult").innerHTML="";
				document.getElementById("searchImage").style.display='<div class=""row>'+'<img src="img/search.jpg" class="col-md-6 col-sm-6" width="400" id="searchImage" style="margin-bottom:50px;">'+'</div>';
			}
		}
	}
	var searchWord = document.getElementById("search").value;
	xmlhttp.open("POST","config/wordSearch.php");
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("search="+searchWord);
}