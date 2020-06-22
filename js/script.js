let pageTitle = document.getElementById('pageTitle')

let showPassword = document.getElementById('showPassword')
let showRepeatPassword = document.getElementById('showRepeatPassword')

let listsDisplay = document.getElementById('listsDisplay')
let userLists = document.getElementById('lists')
let userListItems = document.getElementById('listItems')
let commandsDisplay = document.getElementById('commands')
let commandsButtons = ['new list', 'input:state', 'input:duration', 'remove filter']
let listButtons = ['+', '-', 'edit']
let statusOptions = ['none', 'Done', 'Failed']
let statusColors = [null, 'green', 'red']

let page = location.href

if(showPassword !== null){
    makePasswordVisible('showPassword')
    showPassword.onclick = function(){makePasswordVisible('showPassword')}
}
if(showRepeatPassword !== null){
    makePasswordVisible('showRepeatPassword')
    showRepeatPassword.onclick = function(){makePasswordVisible('showRepeatPassword')}
}

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

if(userLists !== null){
    let data = JSON.parse(userLists.value)
    for (let x = 0; x < commandsButtons.length; x++) {
        if(commandsButtons[x].includes('input:')){
            let names = commandsButtons[x].split('input:')
            if(names[1] == 'state'){
                let input = document.createElement('select')
                input.id = "selectState"
                for (let x = 0; x < statusOptions.length; x++) {
                    let option = document.createElement('option')
                    let text = document.createTextNode(statusOptions[x])
                    if(statusColors[x] !== null){
                        option.style.background = statusColors[x]
                    }
                    option.appendChild(text)
                    option.value = statusOptions[x]
                    option.onclick = function(){location.href = "home.php?filterOn=" + x}
                    input.appendChild(option)
                }
                commandsDisplay.appendChild(input)
            }
            else if (names[1] == 'duration'){
                let input = document.createElement('input')
                input.type = "number"
                input.min = 0
                input.value = 0
                input.id = "durationInput"
                commandsDisplay.appendChild(input)
                input.onchange = function(){
                    location.href = "home.php?duration=" + input.value
                } 
            }
        }
        else{
            let button = document.createElement('button')
            button.innerHTML = commandsButtons[x]
            button.onclick = function(){executeCommand(x)}
            commandsDisplay.appendChild(button)
        }
    }
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
        let durationInput = document.createElement('input')
        durationInput.type = "number"
        durationInput.value = data[i]['duration']
        durationInput.min = 0
        durationInput.onchange = function(){
            location.href = "home.php?duration="+durationInput.value+"&listDurationItemID="+data[i]['id']
        }
        li.appendChild(editContentButton)
        statusChooserSelect.selectedIndex = data[i]['status']
        li.appendChild(statusChooserSelect)
        let text = document.createElement('span')
        text.innerText = "min"
        text.style.color = "black"
        li.appendChild(durationInput)
        li.appendChild(text)
        li.appendChild(removeItemButton)
        list.appendChild(li)
    }
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
}

function executeCommand(index){
    if(commandsButtons[index] == 'new list'){
        let listName = prompt('enter list name', 'list name')
        if(listName !== null && listName !== ''){
            location.href = "home.php?listName="+listName
        }
    }
    else if (commandsButtons[index] == 'remove filter'){
        location.href = "home.php"
    }
}