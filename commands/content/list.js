const commando = require('discord.js-commando');
const request = require('request-promise');

class ListCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'list',
            aliases: [
                'content'                
            ],
            group: 'content',
            memberName: 'list',
            description: 'Returns list of content commands',
            examples: ['!list'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=list',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = ListCommand;
