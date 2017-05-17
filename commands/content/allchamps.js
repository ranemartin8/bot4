const commando = require('discord.js-commando');
const request = require('request-promise');

class allchamps extends commando.Command {
constructor(client) {
        super(client, {
            name: 'allchamps',
            aliases: [
                'allchamps',
                'champslist',
                'champsall'
            ],
            group: 'content',
            memberName: 'allchamps',
            description: 'Returns a list of all Champs by class',
            examples: ['!allchamps'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=allchamps',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = allchamps;
