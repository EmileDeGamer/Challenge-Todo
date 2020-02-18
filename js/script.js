let pageTitle = document.getElementById('pageTitle')

let showPassword = document.getElementById('showPassword')
let showRepeatPassword = document.getElementById('showRepeatPassword')

if(showPassword !== null){
    makePasswordVisible('showPassword')
    showPassword.onclick = function(){makePasswordVisible('showPassword')}
}
if(showRepeatPassword !== null){
    makePasswordVisible('showRepeatPassword')
    showRepeatPassword.onclick = function(){makePasswordVisible('showRepeatPassword')}
}

function makePasswordVisible(passwordType){
    if(passwordType == 'showPassword'){
        let input = document.getElementById('password')    
        if(showPassword.checked){
            input.type = "text"
        }
        else{
            input.type = "password"
        }
    }
    else if (passwordType == 'showRepeatPassword'){
        let input = document.getElementById('repeatPassword')
        if(showRepeatPassword.checked){
            input.type = "text"
        }
        else{
            input.type = "password"
        }
    }
}

let page = location.href

page = page.split('/')
if(page[page.length - 1] == ''){
    pageTitle.innerHTML = "Login"
}
else{
    let tTitle = page[page.length - 1].replace('.php', '').split("")
    tTitle[0] = tTitle[0].toUpperCase()
    tTitle = tTitle.toString().replace(/,/g, '')
    if(tTitle !== "Index"){
        pageTitle.innerHTML = tTitle.split('?')[0]
    }
    else{
        pageTitle.innerHTML = "Login"
    }
}

let listsDisplay = document.getElementById('listsDisplay')
let userLists = document.getElementById('lists')
let userListItems = document.getElementById('listItems')
let commandsDisplay = document.getElementById('commands')
let listButtons = ['+', '-', 'edit', 'sort on state', 'sort on date']
if(userLists !== null){
    let data = JSON.parse(userLists.value)
    let createListButton = document.createElement('button')
    createListButton.innerHTML = "new list"
    createListButton.onclick = function(){
        let listName = prompt('enter list name', 'list name')
        if(listName !== null && listName !== ''){
            location.href = "home.php?listName="+listName
        }
    }
    commandsDisplay.appendChild(createListButton)
    for (let i = 0; i < data.length; i++) {
        let listHolder = document.createElement('div')
        listHolder.id = data[i]['id'] + "holder"
        let buttonsHolder = document.createElement('div')
        let listTitle = document.createElement('h3')
        listTitle.innerHTML = data[i]['listName'].replace(/\/\/\/\/\/zxyxyz\/\/\/\/\//g, ' ')
        buttonsHolder.appendChild(listTitle)
        for (let x = 0; x < listButtons.length; x++) {
            let button = document.createElement('button')
            button.innerHTML = listButtons[x]
            button.onclick = function(){executeListCommand(data[i]['id'], x)}
            buttonsHolder.appendChild(button)
        }
        listHolder.appendChild(buttonsHolder)
        let ul = document.createElement('ul')
        ul.id = data[i]['id']
        listHolder.appendChild(ul)
        listsDisplay.appendChild(listHolder)
    }
}

let statusOptions = ['none', 'Done', 'Failed']
let statusColors = [null, 'green', 'red']
if(userListItems !== null){
    let data = JSON.parse(userListItems.value)
    for (let i = 0; i < data.length; i++) {
        let list = document.getElementById(data[i]['listID'])
        let li = document.createElement('li')
        li.innerHTML = data[i]['listItem'].replace(/\/\/\/\/\/zxyxyz\/\/\/\/\//g, ' ')
        li.id = data[i]['id']
        let removeItemButton = document.createElement('button')
        removeItemButton.innerHTML = "-"
        removeItemButton.onclick = function(){location.href = "home.php?listItemID="+data[i]['id']}
        let statusChooserSelect = document.createElement('select')
        for (let x = 0; x < statusOptions.length; x++) {
            let option = document.createElement('option')
            let text = document.createTextNode(statusOptions[x])
            if(statusColors[x] !== null){
                option.style.background = statusColors[x]
                if(data[i]['status'] == x){
                    li.style.color = statusColors[x]
                }
            }
            option.appendChild(text)
            option.value = statusOptions[x]
            option.onclick = function(){location.href = "home.php?listItemID="+data[i]['id']+"&status="+x}
            statusChooserSelect.appendChild(option)
        }
        let editContentButton = document.createElement('button')
        editContentButton.innerHTML = "edit"
        editContentButton.onclick = function(){
            let editContent = prompt('enter new content', 'content')
            if(editContent !== null && editContent !== ''){
                location.href = "home.php?editedListItem="+editContent+"&listItemID="+data[i]['id']
            }
        }
        let editTimeInputFrom = document.createElement('input')
        editTimeInputFrom.type = "time"
        editTimeInputFrom.name = "timeFrom"
        editTimeInputFrom.value = data[i]['timeFrom']
        let editDateInputFrom = document.createElement('input')
        editDateInputFrom.type = "date"
        editDateInputFrom.name = "dateFrom"
        editDateInputFrom.value = data[i]['dateFrom']
        let editDateInputTill = document.createElement('input')
        editDateInputTill.type = "date" 
        editDateInputTill.name = "dateTill"
        editDateInputTill.value = data[i]['dateTill']
        let editTimeInputTill = document.createElement('input')
        editTimeInputTill.type = "time"
        editTimeInputTill.name = "timeTill"
        editTimeInputTill.value = data[i]['timeTill']
        let submitDateAndTimeButton = document.createElement('button')
        submitDateAndTimeButton.innerHTML = "Submit date and time"
        submitDateAndTimeButton.onclick = function(){
            let urlstring = []
            if(editTimeInputFrom.value !== ''){
                urlstring.push("timeFrom=" + editTimeInputFrom.value)
            }
            if(editTimeInputTill.value !== ''){
                urlstring.push("timeTill=" + editTimeInputTill.value)
            }
            if(editDateInputTill.value !== ''){
                urlstring.push("dateTill=" + editDateInputTill.value)
            }
            if(editDateInputFrom.value !== ''){
                urlstring.push("dateFrom=" + editDateInputFrom.value)
            }

            let url = "home.php?listDateItemID="+data[i]['id']+"&"

            for (let x = 0; x < urlstring.length; x++) {
                if(urlstring.length == 1){
                    url.href = url + urlstring[x]
                }
                else{
                    if(x !== urlstring.length - 1){
                        url += urlstring[x] + "&"
                    }
                    else{
                        url += urlstring[x]
                    }   
                }
            }

            location.href = url
        }
        li.appendChild(editContentButton)
        statusChooserSelect.selectedIndex = data[i]['status']
        li.appendChild(statusChooserSelect)
        li.appendChild(editTimeInputFrom)
        li.appendChild(editDateInputFrom)
        li.appendChild(editTimeInputTill)
        li.appendChild(editDateInputTill)
        li.appendChild(submitDateAndTimeButton)
        li.appendChild(removeItemButton)
        list.appendChild(li)
    }
}

let order = ['green', '', 'red']
function executeListCommand(listID, index){
    if(listButtons[index] == "+"){
        let listItemContent = prompt('enter list content', 'content')
        if(listItemContent !== null && listItemContent !== ''){
            location.href = "home.php?listItem="+listItemContent+"&listID="+listID
        }
    }
    else if (listButtons[index] == "-"){
        location.href = "home.php?listToRemoveID="+listID
    }
    else if(listButtons[index] == 'edit'){
        let editListName = prompt('enter list new list name', 'name')
        if(editListName !== null && editListName !== ''){
            location.href = "home.php?editedListName="+editListName+"&listID="+listID
        }
    }
    else if(listButtons[index] == 'sort on state'){
        let list = document.getElementById(listID)
        let newList = []
        for (let y = 0; y < order.length; y++) {
            for (let i = 0; i < list.children.length; i++) {
                if (list.childNodes[i].style.color == order[y]){
                    newList.push(list.childNodes[i])
                }
            }
        }
        list.innerHTML = ""
        for (let i = 0; i < newList.length; i++) {
            list.appendChild(newList[i])
        }
        order = order.reverse()
    }
    else if  (listButtons[index] == 'sort on date'){
        let list = document.getElementById(listID)
        let newList = []
        let values = []
        let ids = []
        for (let i = 0; i < list.children.length; i++) {
            let idsArray = ['dateFrom', 'dateTill', 'timeFrom', 'timeTill']
            for (let x = 0; x < list.childNodes[i].children.length; x++) {
                for (let z = 0; z < idsArray.length; z++) {
                    if(idsArray[z] == list.childNodes[i].childNodes[x].name){
                        values.push(list.childNodes[i].childNodes[x].value)
                        if(ids.indexOf(list.childNodes[i].id) == -1){
                            ids.push(list.childNodes[i].id)
                        }
                    }
                }
            }
        }
        let dates = []
        for (let x = 0; x < values.length; x++) {
            dates.push(new Date(values[1] + " " + values[0]))
            values.shift()
            values.shift()
            values.shift()
            values.shift()
        }
        /*list.innerHTML = ""
        for (let x = 0; x < dates.length; x++) {
            for (let i = 0; i < newList.length; i++) {
                list.appendChild(newList[i])
            }
        }*/
        console.log(dates)
        let idOrder = []
        dates = dates.sort((a, b) => b - a)
        console.log(dates)
        for (let i = 0; i < dates.length; i++) {
            idOrder.push(dates[ids.indexOf(dates[i])])
        }
        console.log(idOrder)
    }
}