let pageTitle = document.getElementById('pageTitle')

let menuButtonsDisplay = document.getElementById('menuButtons')

let menuButtons = ['Login', 'Register']

for (let i = 0; i < menuButtons.length; i++) {
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
}

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

let commandsDisplay = document.getElementById('commands')
if(commandsDisplay !== null){
    let commands = ['create', 'delete', '']

    let exampleList = document.getElementById('exampleList')
    
    let listItems = document.getElementById('listItems')
    
    let exampleListItems = ['pizza', 'test', 'code']
    
    for (let i = 0; i < exampleListItems.length; i++) {
        let li = document.createElement('li')
        li.innerHTML = exampleListItems[i]
        exampleList.appendChild(li)
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
        pageTitle.innerHTML = tTitle
    }
    else{
        pageTitle.innerHTML = "Login"
    }
}