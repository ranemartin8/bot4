const commando = require('discord.js-commando');
const request = require('request-promise');

class t4basicCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 't4basic',
            aliases: [
                't4'
            ],
            group: 'content',
            memberName: 't4basic',
            description: 'Returns T4 Basic Arena Schedule',
            examples: ['!t4basic'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=t4basic',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = t4basicCommand;
