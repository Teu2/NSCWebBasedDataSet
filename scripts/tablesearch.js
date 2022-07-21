/**
* Author: Group 2
* Target: home.html
* Purpose: This file is used to add javascript to home.html.
* Created: 21/07/2022
* Last updated: 21/07/2022
*/
var tableData = [{}]

let bugName = ['botan/asn1','openjpeg/opj_decompress_fuzzer','matio:matio_fuzzer','augeas/augeas_escape_name_fuzzer','tpm2/tpm2_execute_command_fuzzer','yara/rules_fuzzer'];
let bugType = ['Bug','Bug-Security'];
let bugRegression = ['Regresses','Not Regressed'];

function createData(){
    return {
        'bug_name': bugName[Math.floor(Math.random() * bugName.length)],
        'bug_type': bugType[Math.floor(Math.random() * bugType.length)],
        'bug_input': 'Link',
        'bug_commit': 'Link',
        'regression': bugRegression[Math.floor(Math.random() * bugRegression.length)],
        'status': 'Fixed',
        'report_date': '21/07/2020',
        'fix_date': '21/07/2090',
        
    }
}

for(var i = 1; i < 1000; i++){ // 1000 value is just used to replicate how many thigns we'll get from the database
    tableData.push(createData(i));
}
    
var state = {
'querySet': tableData,

'page': 1,
'rows': 16,
'window': 5,
}

buildTable()

function pagination(querySet, page, rows) {

var trimStart = (page - 1) * rows
var trimEnd = trimStart + rows

var trimmedData = querySet.slice(trimStart, trimEnd)

var pages = Math.round(querySet.length / rows);

return {
    'querySet': trimmedData,
    'pages': pages,
}
}

function pageButtons(pages) {
    var wrapper = document.getElementById('pagination-wrapper')
    wrapper.innerHTML = ``

    var maxLeft = (state.page - Math.floor(state.window / 2))
    var maxRight = (state.page + Math.floor(state.window / 2))

    if (maxLeft < 1) {
        maxLeft = 1
        maxRight = state.window
    }

    if (maxRight > pages) {
        maxLeft = pages - (state.window - 1)
        
        if (maxLeft < 1){
            maxLeft = 1
        }
        maxRight = pages
    }

    for (var page = maxLeft; page <= maxRight; page++) {
        wrapper.innerHTML += `<button value=${page} class="page btn btn-sm btn-info">${page}</button>`
    }

    if (state.page != 1) {
        wrapper.innerHTML = `<button value=${1} class="page btn btn-sm btn-info">&#171; First</button>` + wrapper.innerHTML
    }

    if (state.page != pages) {
        wrapper.innerHTML += `<button value=${pages} class="page btn btn-sm btn-info">Last &#187;</button>`
    }

    $('.page').on('click', function() {
        $('#table-body').empty()

        state.page = Number($(this).val())

        buildTable()
    })

}

function buildTable() {
var table = $('#table-body')

var data = pagination(state.querySet, state.page, state.rows)
var myList = data.querySet

for (let i in myList) {
    var row = `<tr>
                <td class="name">${myList[i].bug_name}</td>
                <td>${myList[i].bug_type}</td>
                <td class="link"><a href="https://oss-fuzz.com/testcase?key=4859939824599040">${myList[i].bug_input}</a></td>
                <td class="link"><a href="https://github.com/google/oss-fuzz/blob/master/docs/reproducing.md">${myList[i].bug_commit}</a></td>
                <td>${myList[i].regression}</td>
                <td><p class="fixed">${myList[i].status}</p></td>
                <td>${myList[i].report_date}</td>
                <td>${myList[i].fix_date}</td>
              `
    table.append(row)
}

pageButtons(data.pages)
}
