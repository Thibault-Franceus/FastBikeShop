document.addEventListener("DOMContentLoaded", () => {
    // Profile Dropdown
    const profileButton = document.querySelector(".profile .dropdown-toggle");
    const profileMenu = document.querySelector(".profile-menu");
  
    // Basket Dropdown
    const basketButton = document.querySelector(".basket .dropdown-toggle");
    const basketMenu = document.querySelector(".basket-menu");
  
    // Handle dropdown visibility
    const toggleDropdown = (button, menu) => {
      button.addEventListener("mouseenter", () => {
        menu.style.display = "block";
        menu.style.opacity = "1";
        menu.style.visibility = "visible";
      });
  
      button.addEventListener("mouseleave", () => {
        setTimeout(() => {
          if (!menu.matches(":hover")) {
            menu.style.display = "none";
            menu.style.opacity = "0";
            menu.style.visibility = "hidden";
          }
        }, 100);
      });
  
      menu.addEventListener("mouseleave", () => {
        menu.style.display = "none";
        menu.style.opacity = "0";
        menu.style.visibility = "hidden";
      });
  
      menu.addEventListener("mouseenter", () => {
        menu.style.display = "block";
        menu.style.opacity = "1";
        menu.style.visibility = "visible";
      });
    };
  
    toggleDropdown(profileButton, profileMenu);
    toggleDropdown(basketButton, basketMenu);
  });


  