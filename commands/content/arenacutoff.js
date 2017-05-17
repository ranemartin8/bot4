const commando = require('discord.js-commando');
const request = require('request-promise');

class arenacutoffCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'arenacutoff',
            aliases: [
                'cutoffs',
                'arenacutoffs',
                'arenascores'
            ],
            group: 'content',
            memberName: 'arenacutoff',
            description: 'Returns link to Arena cut offs Google Sheet',
            examples: ['!arenacutoff'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=arenacutoff',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = arenacutoffCommand;
