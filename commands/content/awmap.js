const commando = require('discord.js-commando');
const request = require('request-promise');

class AWMap extends commando.Command {
constructor(client) {
        super(client, {
            name: 'awmap',
            aliases: [
                'warmap'
            ],
            group: 'content',
            memberName: 'awmap',
            description: 'Returns Alliance War map',
            examples: ['!awmap'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=awmap',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = AWMap;
