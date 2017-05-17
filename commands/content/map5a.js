const commando = require('discord.js-commando');
const request = require('request-promise');

class Map5a extends commando.Command {
constructor(client) {
        super(client, {
            name: 'map5a',
            aliases: [
                'map51'
            ],
            group: 'content',
            memberName: 'map5a',
            description: 'Returns map5a',
            examples: ['!map5a'],
        });   
    }
    async run(msg) {
  // const response = ':map:   **AQ Map 5 - Section 1** \n\n http://i.imgur.com/hAAQ3Az.jpg';
      const response = await request({
           method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=map5a',
            followAllRedirects: true,
           headers: { 'User-Agent': `Commando` },
           json: false
       });
        if (!response) {
            var reply = ':map:   **AQ Map 5 - Section 1** \n\n http://i.imgur.com/hAAQ3Az.jpg';
        } 
        else { 
            var reply = response;
        }


        return msg.say(reply);
    }
}
module.exports = Map5a;
