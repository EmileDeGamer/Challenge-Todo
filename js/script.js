let pageTitle = document.getElementById('pageTitle')

let menuButtonsDisplay = document.getElementById('menuButtons')

//let menuButtons = ['Login', 'Register', 'Logout']

/*for (let i = 0; i < menuButtons.length; i++) {
    let li = document.createElement('li')
    let a = document.createElement('a')
    a.innerHTML = menuButtons[i]
    if(menuButtons[i] !== 'Login'){
        a.href = menuButtons[i].toLowerCase() + ".php"
    }
    else{
        a.href = "../pages"
    }
    li.appendChild(a)
    menuButtonsDisplay.appendChild(li)
}*/

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

/*let commandsDisplay = document.getElementById('commands')
if(commandsDisplay !== null){
    let commands = ['create', 'insert', 'delete']

    for (let i = 0; i < commands.length; i++) {
        let button = document.createElement('button')
        button.innerHTML = commands[i]
        button.onclick = function(){executeCommand(i)}
        commandsDisplay.appendChild(button)
    }

    /*let exampleList = document.getElementById('exampleList')
    
    let listItems = document.getElementById('listItems')
    
    let exampleListItems = ['pizza', 'test', 'code']
    
    for (let i = 0; i < exampleListItems.length; i++) {
        let li = document.createElement('li')
        li.innerHTML = exampleListItems[i]
        listItems.appendChild(li)
    }

    function executeCommand(i){
        if(commands[i] == 'create'){
            let listName = prompt('enter list name', 'name')
            location.href = "home.php?listName="+listName
        }
        else if (commands[i] == 'delete'){

        }
        else if (commands[i] == 'insert'){
            let listName = prompt('enter list name', 'name')
            let listItem = prompt('enter list item content' , 'content')
            location.href = "home.php?listName="+listName+"&listItem="+listItem
        }
    }
}*/

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

/*let lists = document.getElementById('lists')
if(lists !== null){
    if(lists.value !== null){
        let listsDisplay = document.getElementById('listsDisplay')
        console.log(lists.value)
        lists.value = lists.value.replace("[{", "").replace("}]", "")
        let arr = lists.value.split(',')
        for (let i = 0; i < arr.length; i++) {
            if(arr.indexOf(i) == -1){
                arr.splice(i, 1)
                arr[i] = arr[i].replace('"' + i + '":', "")
            }
        }
        arr[2] = arr[2].replace('"[', "")
        arr[2] = arr[2].replace(']"', "")
        let userLists = arr[2].split('listName:')
        for (let i = 1; i < userLists.length; i++) {
            let ul = document.createElement('ul')
            userLists[i] = userLists[i].replace('"', "")
            userLists[i] = userLists[i].replace(']', "")
            userLists[i] = userLists[i].replace(/\\/, "")
            ul.id = userLists[i]
            let ulTitle = document.createElement('h3')
            ulTitle.innerHTML = userLists[i]
            ul.appendChild(ulTitle)
            listsDisplay.appendChild(ul)
        }
        console.log(userLists)
    }
}   
let listItems = document.getElementById('listItems')
if(listItems !== null){
    console.log(listItems.value)
}*/

//list on click has to put id with it

let userLists = document.getElementById('lists')
let userListItems = document.getElementById('listItems')
let commandsDisplay = document.getElementById('commands')
let listButtons = ['+', '-']
if(userLists !== null){
    let data = JSON.parse(userLists.value)
    let createListButton = document.createElement('button')
    createListButton.innerHTML = "new list"
    createListButton.onclick = function(){
        let listName = prompt('enter list name', 'list name')
        if(listName !== null){
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
        let removeItemButton = document.createElement('button')
        removeItemButton.innerHTML = "-"
        removeItemButton.onclick = function(){location.href = "home.php?listItemID="+data[i]['id']}
        let statusChooserSelect = document.createElement('select')
        for (let x = 0; x < statusOptions.length; x++) {
            let option = document.createElement('option')
            let text = document.createTextNode(statusOptions[x])
            if(statusColors[x] !== null && data[i]['status'] == x){
                option.style.background = statusColors[x]
                li.style.color = statusColors[x]
            }
            option.appendChild(text)
            option.value = statusOptions[x]
            option.onclick = function(){location.href = "home.php?listItemID="+data[i]['id']+"&status="+x}
            statusChooserSelect.appendChild(option)
        }
        statusChooserSelect.selectedIndex = data[i]['status']
        li.appendChild(statusChooserSelect)
        li.appendChild(removeItemButton)
        list.appendChild(li)
    }
}

function executeListCommand(listID, index){
    if(listButtons[index] == "+"){
        let listItemContent = prompt('enter list content', 'content')
        if(listItemContent !== null){
            location.href = "home.php?listItem="+listItemContent+"&listID="+listID
        }
    }
    else if (listButtons[index] == "-"){
        location.href = "home.php?listToRemoveID="+listID
    }
}