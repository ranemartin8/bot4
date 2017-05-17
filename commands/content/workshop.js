const commando = require('discord.js-commando');
const request = require('request-promise');

class workshopCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'workshop',
            aliases: [
                'rocketsworkshop',
                'scrapyard',
                'scrap'
            ],
            group: 'content',
            memberName: 'workshop',
            description: 'Returns Rockets Scrapyard & Workshop Info',
            examples: ['!rankupcost'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=workshop',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = workshopCommand;
