const commando = require('discord.js-commando');
const request = require('request-promise');

class AnotherQuickCommand extends commando.Command {
constructor(client) {
        super(client, {
            name: 'grab',
            group: 'tools',
            memberName: 'grab',
            description: 'Returns requested item. Example: !grab awmap',
            examples: [';grab awmap'],
            args: [{
                key: 'champName',
                prompt: 'What content are you looking for?\n\n **Reply with:** \n - awmap \n - 5starchamps\n - arenacutoff\n - arenabasic\n - awmap\n - masterycost\n - rankupcost\n - schedule\n - t4basic\n - aqduels \n - list (full list of options)\n\n',
                type: 'string'
            }]
        });   
    }

    async run(msg, args) {
        const { champName } = args;
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/quick.php?c=' + champName,
            followAllRedirects: true,
            headers: { 'User-Agent': `Commando` },
            json: false
        });

      //  const title = response.name;
      //  const body = response.quick;
      //  const picture = response.img;
      //  const click = response.click;        
      //  const color = response.color;                               


        return msg.say(response);

    }

}

module.exports = AnotherQuickCommand;
