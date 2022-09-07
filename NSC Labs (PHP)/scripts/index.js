/**
* Author: Group 2
* Target: home.html
* Purpose: This file is used to add javascript to home.html.
* Created: 24/05/2022
* Last updated: 24/05/2022
*/

function search(){
  let input, filter, table, tr, td, txtValue;

  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementsByClassName("table");
  tr = table[0].getElementsByTagName("tr");

  for(let i = 0; i < tr.length; i++){
    td = tr[i].getElementsByTagName("td")[0];

    if(td){
      txtValue = td.textContent || td.innerText;

      if(txtValue.toUpperCase().indexOf(filter) > -1){
        tr[i].style.display = "";
      }
      else{
        tr[i].style.display = "none";
      }
    }
  }
}