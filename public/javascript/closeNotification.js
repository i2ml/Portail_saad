let Notification = document.getElementById("notification");
Notification.style.transform = "translateX(150%)";
Notification.classList.remove("hidden");
Notification.style.transform = "translateX(0%)";
function closeModal() {
    Notification.style.transform = "translateX(150%)";
    Notification.classList.remove("hidden");
}