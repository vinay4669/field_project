    const dapp = document.querySelectorAll('.dapp')
    const drej = document.querySelectorAll('.drej')
    const rapp = document.querySelectorAll('.rapp')
    const rrej = document.querySelectorAll('.rrej')
    
    dapp.forEach(function(button){
        button.addEventListener('click', ()=>{
            var a = button.value
            window.location.href="judge.php?type=donate&res=1&dt="+a
        })
    })

    drej.forEach(function(button){
        button.addEventListener('click', ()=>{
            var a = button.value
            window.location.href="judge.php?type=donate&res=-1&dt="+a
        })
    })

    rapp.forEach(function(button){
        button.addEventListener('click', ()=>{
            var a = button.value
            window.location.href="judge.php?type=request&res=1&dt="+a
        })
    })

    rrej.forEach(function(button){
        button.addEventListener('click', ()=>{
            var a = button.value
            window.location.href="judge.php?type=request&res=-1&dt="+a
        })
    })