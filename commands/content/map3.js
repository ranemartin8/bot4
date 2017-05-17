const commando = require('discord.js-commando');
const request = require('request-promise');

class Map3 extends commando.Command {
constructor(client) {
        super(client, {
            name: 'map3',
            aliases: [
                'map3a', 'map3b','map3c'
            ],
            group: 'content',
            memberName: 'map3',
            description: 'Returns Map 3',
            examples: ['!map2'],
        });   
    }
    async run(msg) {
  // const response = ':map:   **AQ Map 5 - Section 1** \n\n http://i.imgur.com/hAAQ3Az.jpg';
      const response = await request({
           method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=map3',
            followAllRedirects: true,
           headers: { 'User-Agent': `Commando` },
           json: false
       });
        if (!response) {
            var reply = ':map:   **AQ Map 3** \n\n http://i.imgur.com/lYHRqun.png';
        } 
        else { 
            var reply = response;
        }


        return msg.say(reply);
    }
}
module.exports = Map3;
