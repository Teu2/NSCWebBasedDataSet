/**
* Author: Group 2
* Target: home.html
* Purpose: This file is used to add javascript to home.html.
* Created: 24/05/2022
* Last updated: 24/05/2022
*/

function search(){
  let input, filter, table, tr, td, txtValue, count, countNum = 0;

  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementsByClassName("table");
  tr = table[0].getElementsByTagName("tr");

  for(let i = 0; i < tr.length; i++){
    td = tr[i].getElementsByTagName("td");
    count = document.getElementById('count');
	for(j = 0; j < td.length; j++){
		if(td[j]){
		  txtValue = td[j].textContent || td[j].innerText;
		  
		  if(txtValue.toUpperCase().indexOf(filter) > -1){
			tr[i].style.display = "";
			countNum++;
			count.innerHTML = `Showing '${countNum}' of 1000`;
			break;
		  }
		  else{
			tr[i].style.display = "none";
		  }
		}
		else{
		  count.innerHTML = `Showing '0' of 1000`;
		}
	}	
  }

  // count.innerHTML = countNum;
}