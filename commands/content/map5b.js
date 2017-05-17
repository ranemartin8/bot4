const commando = require('discord.js-commando');
const request = require('request-promise');

class Map5b extends commando.Command {
constructor(client) {
        super(client, {
            name: 'map5b',
            aliases: [
                'map52'
            ],
            group: 'content',
            memberName: 'map5b',
            description: 'Returns map5b',
            examples: ['!map5b'],
        });   
    }
    async run(msg) {
    const response = ':map:   **AQ Map 5 - Section 2** \n\n http://i.imgur.com/P9vFHXM.jpg';
      //  const response = await request({
        //    method: 'GET',
       //     uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=map5b',
       //     followAllRedirects: true,
        //    headers: { 'User-Agent': `Commando` },
        //    json: false
      //  });
        return msg.say(response);
    }
}
module.exports = Map5b;
