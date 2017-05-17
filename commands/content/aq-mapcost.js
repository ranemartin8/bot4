const commando = require('discord.js-commando');
const request = require('request-promise');

class aqmapcostsCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'aqmapcosts',
            aliases: [
                'aq-mapcosts',
                'mapcost',
                'mapcosts',
                'aq-mapcost',
                'aq_mapcosts'
            ],
            group: 'content',
            memberName: 'aq-mapcosts',
            description: 'Returns AQ Map Costs',
            examples: ['!aq-mapcosts'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=aqmapcosts',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = aqmapcostsCommand;
