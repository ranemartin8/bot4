const commando = require('discord.js-commando');
const request = require('request-promise');

class glorystoreCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'glorystore',
            aliases: [
                'glory'
            ],
            group: 'content',
            memberName: 'glorystore',
            description: 'Returns Glory Store Item Costs',
            examples: ['!glorystore'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=glorystore',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = glorystoreCommand;
