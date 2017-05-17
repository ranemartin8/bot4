const commando = require('discord.js-commando');
const request = require('request-promise');


class statsCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'stats',
            group: 'champpi',
            memberName: 'stats',
            aliases: [
                'data'
            ],
            description: 'Returns stats about a champions include Sig Ability values and PI.',
            examples: ['!stats deadpool'],
            args: [{
                key: 'champName',
                prompt: 'Which champion do you want information on?\n\n',
                type: 'string'
            }]
        });
    }

    async run(msg, args) {
        const {
            champName
        } = args;
        const response = await request({
            method: 'GET',
            uri: 'https://assgardians.000webhostapp.com/mcoc_db/data.php?c=' + champName,
            followAllRedirects: true,
            headers: {
                'User-Agent': `Commando`
            },
            json: true
        });
        const status = response.status;
        const name = response.name;
        const uppername = name.toUpperCase();
        const lowername = name.toLowerCase();
        const stripedname = lowername.replace(/(\-|\(|\)|\.|\s|\,)/g, "");
        
 
        const datavalues = response.datavalues;

        const img = response.img;


        const nameclass = response.heroclass_name;
        const colorname = response.color;
        const class_icon = response.heroclass_icon;

        const editdata = datavalues.replace(/\[b\]/g, "\n");
        const stardata = editdata.replace(/\[s\]/g, "\u2606 ");  
        const final = stardata.replace(/\[a\]/g, "**\u21E2**");

        // https://www.w3schools.com/charsets/ref_utf_symbols.asp
        //⇪ = 21EA  ⇫	= 21EB  ◆ = 25C6  ◇ 25C7 

        const desc = '**Stats for: ' + uppername + '**' + final + '\n\n*Reply "!info ' + stripedname + '" for more info*';
        if (status == 'success') {

            return msg.embed({
                description: desc,
                thumbnail: {
                    url: img
                },
                color: colorname,
                footer: {
                    icon_url: class_icon,
                    text: nameclass
                }
            });
        } else {
            return msg.say(':warning:   Champion not found. Please check the spelling and try again.');
        }
    }

}

module.exports = statsCommand;