const commando = require('discord.js-commando');
const request = require('request-promise');

class aqduelsCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'aqduels',
            aliases: [
                'aqduel'
            ],
            group: 'content',
            memberName: 'aqduels',
            description: 'Returns AQ Boss Duel Targets',
            examples: ['!aqduels'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=aqduels',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = aqduelsCommand;
