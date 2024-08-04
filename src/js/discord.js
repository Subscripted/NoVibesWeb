fetch('https://discord.com/api/guilds/1102188267513843782/widget.json')
    .then(response => response.json())
    .then(data => {
        const totalMembers = data.members.length;
        const onlineMembers = data.members.filter(member => member.status === 'online').length;

        document.getElementById('discord-online-count').innerText = `(${onlineMembers} online)`;
    })
    .catch(error => console.error('Fehler beim Abrufen der Discord-Daten:', error));
