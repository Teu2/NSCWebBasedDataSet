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
    td = tr[i].getElementsByTagName("td")[0];
    count = document.getElementById('count');

    if(td){
      txtValue = td.textContent || td.innerText;

      if(txtValue.toUpperCase().indexOf(filter) > -1){
        tr[i].style.display = "";
        countNum++;
        count.innerHTML = `Showing '${countNum}' of 1000`;
      }
      else{
        tr[i].style.display = "none";
      }
    }
    else{
      count.innerHTML = `Showing '0' of 1000`;
    }
  }

  // count.innerHTML = countNum;
}