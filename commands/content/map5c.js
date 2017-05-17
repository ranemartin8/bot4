const commando = require('discord.js-commando');
const request = require('request-promise');

class Map5c extends commando.Command {
constructor(client) {
        super(client, {
            name: 'map5c',
            aliases: [
                'map53'
            ],
            group: 'content',
            memberName: 'map5c',
            description: 'Returns map5c',
            examples: ['!map5c'],
        });   
    }
    async run(msg) {
     const response = ':map:   **AQ Map 5 - Section 3** \n\n http://i.imgur.com/ElsxFYt.jpg';
      //  const response = await request({
        //    method: 'GET',
       //     uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=map5c',
       //     followAllRedirects: true,
        //    headers: { 'User-Agent': `Commando` },
        //    json: false
      //  });
        return msg.say(response);
    }
}
module.exports = Map5c;
