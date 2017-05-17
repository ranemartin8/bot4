const commando = require('discord.js-commando');
const request = require('request-promise');

class MasteryCost extends commando.Command {
constructor(client) {
        super(client, {
            name: 'masterycost',
            aliases: [
                'masterycosts',
                'mastercost',
                'masteries',
                'mastery'
                
            ],
            group: 'content',
            memberName: 'masterycost',
            description: 'Returns mastery costs',
            examples: ['!masterycost'],
        });   
    }
    async run(msg) {
      //  const response = await request({
         //    method: 'GET',
        //     uri: 'https://assgardians.000webhostapp.com/mcoc_db/content.php?c=masterycost',
        //     followAllRedirects: true,
         //    headers: { 'User-Agent': `Commando` },
         //    json: false
       //  });
        return msg.say('http://i.imgur.com/BqxCRq9.jpg');
    }
}
module.exports = MasteryCost;
