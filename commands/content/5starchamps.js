const commando = require('discord.js-commando');
const request = require('request-promise');

class FiveStarChamps extends commando.Command {
constructor(client) {
        super(client, {
            name: '5starchamps',
            aliases: [
                '5starchamp',
                '5stars',
                '5*',
                '5*champs',
                '5',
                'fivestarchamps'
            ],
            group: 'content',
            memberName: '5starchamps',
            description: 'Returns 5 Star Champs',
            examples: ['!5starchamps'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=5starchamps',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = FiveStarChamps;
