const Notification = document.getElementById("notification");
Notification.style.transform = "translateX(150%)";
Notification.classList.remove("hidden");
Notification.style.transform = "translateX(0%)";

/**
 * @description Close the notification
 */
function closeModal() {
    Notification.style.transform = "translateX(150%)";
    Notification.classList.remove("hidden");
}