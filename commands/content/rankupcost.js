const commando = require('discord.js-commando');
const request = require('request-promise');

class RankUpCost extends commando.Command {
constructor(client) {
        super(client, {
            name: 'rankupcost',
            aliases: [
                'rankup',
                'rankupcosts',
                'upgrapecost',
                'upgrade'
                
            ],
            group: 'content',
            memberName: 'rankupcost',
            description: 'Returns rank up cost',
            examples: ['!rankupcost'],
        });   
    }
    async run(msg) {
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=rankupcost',
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });
        return msg.say(response);
    }
}
module.exports = RankUpCost;
