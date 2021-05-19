const hoverProduct = document.querySelector(".hover-product");
const bigMenuItems = document.querySelector(".big-menu-items");
const brandProduct = document.querySelectorAll(".brand-product");
const logo = document.getElementById("show-logo");
const menuIcon = document.querySelector(".menu-icon");
const responsiveMenuContainer = document.querySelector(".responsive-ul");
const mainContainerItemsMenus = document.querySelectorAll(
  ".main-container-items-menu"
);
const underMenuOption = document.querySelector(".under-menu-option");
const responsiveUnderMenu = document.querySelector(".responsive-under-menu");
const underMenuAngle = document.querySelector(".under-menu-angle");
const underUnderMenu = document.querySelectorAll(".under-menu-option li");

hoverProduct.addEventListener("mouseenter", () => {
  bigMenuItems.classList.add("active");
});

hoverProduct.addEventListener("mouseleave", () => {
  bigMenuItems.classList.remove("active");
});

brandProduct.forEach((btn) => {
  btn.addEventListener("mouseenter", updateMenu);
});

function updateMenu() {
  const itemContainer = this.querySelector(".main-container-items-menu");

  mainContainerItemsMenus.forEach((item) => {
    item.classList.remove("active");
  });

  brandProduct.forEach((btn) => {
    btn.addEventListener("mouseenter", updateMenu);
  });

  itemContainer.classList.add("active");
}

menuIcon.addEventListener("click", () => {
  responsiveMenuContainer.classList.toggle("active");
});

const listItems = [...document.getElementsByClassName('list-item')];
listItems.forEach((item) => {
  const currentSubItems = [
    ...document.querySelectorAll(`.list-item.sub[data-for~="${item.id}"]`),
  ];
  currentSubItems.forEach((subItem) => subItem.classList.add('hidden'));

  let showSub = false;
  item.addEventListener('click', (event) => {
    showSub = item.classList.contains('active');
    item.classList.toggle('active');

    currentSubItems.forEach((subItem) => {
      subItem.classList.remove('active');
      const isNestedSub = subItem.dataset.for.includes(' ');
      if (!showSub && isNestedSub && !item.classList.contains('sub')) {
        console.log(item);
        return subItem.classList.add('hidden');
      }
      showSub
        ? subItem.classList.add('hidden')
        : subItem.classList.remove('hidden');
    });
    showSub = !showSub;
  });
});
