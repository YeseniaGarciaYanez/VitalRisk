function init() {
    console.log('Initializing document....');
    showMenu();
}

function showMenu() {
    //Parent
    var parent = document.getElementById('menu');
    menu.forEach(item => {
        //Create item div
        var divItem = createMenuItem(item);
        
        // Event listener for main item
        divItem.addEventListener('click', () => {
            if (item.subItems.length > 0) {
                toggleSubMenu(divItem, item.subItems);
            } else {
                window.location.href = item.url;
            }
        });

        //add div to parent
        parent.appendChild(divItem);
    });
}
function createMenuItem(item) {
    console.log(item);

    // Create item div
    var divItem = document.createElement('div');
    divItem.id = 'div-menu-item-' + item.id;
    divItem.className = 'menu-item';

    // Create icon div
    var divIcon = document.createElement('div');
    divIcon.className = 'menu-item-icon';
    divIcon.style.background = item.color;
    divItem.appendChild(divIcon);

    // Icon
    var icon = document.createElement('i');
    icon.className = 'fas fa-' + item.icon;
    divIcon.appendChild(icon);

    // Label
    var label = document.createElement('label');
    label.textContent = item.title;
    divItem.appendChild(label);

    // Return div
    return divItem;
}


function toggleSubMenu(parentDiv, subItems) {
    // Check if the submenu is already open
    var existingSubMenu = parentDiv.nextElementSibling; // Check the next sibling for sub-menu
    if (existingSubMenu && existingSubMenu.classList.contains('sub-menu')) {
        // Close it if it exists
        existingSubMenu.remove();
        parentDiv.classList.remove('active'); // Remove active class
    } else {
        // Create sub-menu
        var subMenu = document.createElement('div');
        subMenu.className = 'sub-menu';

        subItems.forEach(subItem => {
            var divSubItem = document.createElement('div');
            divSubItem.className = 'sub-menu-item';
            divSubItem.textContent = subItem.title;

            // Add click event for sub-item
            divSubItem.addEventListener('click', (event) => {
                event.stopPropagation();  // Prevent event bubbling
                window.location.href = subItem.url;
            });

            subMenu.appendChild(divSubItem);
        });

        parentDiv.parentNode.insertBefore(subMenu, parentDiv.nextSibling);
        parentDiv.classList.add('active'); // Add active class
    }
}


