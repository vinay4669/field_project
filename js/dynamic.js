// Get all the buttons with class sidebar-button
var sidebarButtons = document.querySelectorAll('.sidebar-button');
// console.log("Dynamic working")
// add EventListener to all the buttons
sidebarButtons.forEach(function(button){
    button.addEventListener('click', function(){
        
        // setting the color of the rest of the buttons as default i.e. transparent
        sidebarButtons.forEach(function(button){
            button.style = "background-color: transparent";
        });
        
        // setting a special color to the clicked button
        this.style = "background-color: whitesmoke; color:black";
        
        // get target content ID i.e. id of the content that corresponds to the click of that particular button
        var targetId = this.dataset.contentTarget;

        // to hide rest of the content items
        var contentItems = document.querySelectorAll('.content-item');
        contentItems.forEach(function(item){
            item.style.display = 'none';
        });

        // to show the content item whose button iś clicked
        var targetItem = document.getElementById(targetId);
        targetItem.style.display = 'flex';

    });
});

