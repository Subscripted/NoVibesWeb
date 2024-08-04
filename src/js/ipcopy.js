document.addEventListener('DOMContentLoaded', function() {
    var connectButton = document.getElementById('connect-button');
    var notification = document.getElementById('notification');
    var notificationClose = document.getElementById('notification-close');
    var serverIP = 'novibes.de';

    connectButton.addEventListener('click', function() {
        navigator.clipboard.writeText(serverIP).then(function() {
            showNotification('Server IP in die Zwischenablage kopiert!');
        }, function(err) {
            console.error('Fehler beim Kopieren in die Zwischenablage: ', err);
            showNotification('Fehler beim Kopieren der Server IP.');
        });
    });

    function showNotification(message) {
        var messageElement = document.getElementById('notification-message');
        messageElement.textContent = message;
        notification.classList.add('slide-in');
        notification.style.display = 'block';

        setTimeout(function() {
            notification.classList.add('fade-out');
            setTimeout(function() {
                notification.style.display = 'none';
                notification.classList.remove('slide-in', 'fade-out');
            }, 500);
        }, 3000);
    }


    notificationClose.addEventListener('click', function() {
        notification.classList.add('fade-out');
        setTimeout(function() {
            notification.style.display = 'none';
            notification.classList.remove('slide-in', 'fade-out');
        }, 500);
    });
});
