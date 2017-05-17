const commando = require('discord.js-commando');
const request = require('request-promise');


class SynCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'syn',
            group: 'champpi',
            memberName: 'syn',
            description: 'Returns a champions synergies.',
            examples: ['!syn captainamerica'],
            args: [{
                key: 'champname',
                prompt: 'Provide champ name\n\n',
                type: 'string'
            }]
        });   
    }

	async run(msg, args) {
		const { champname } = args;
		const response = await request({
			method: 'GET',
			uri: 'https://assgardians.000webhostapp.com/mcoc_db/syn2.php?c=' + champname,
			followAllRedirects: true,
			headers: { 'User-Agent': `Commando` },
			json: false
		});

       const getinfo = await request({
			method: 'GET',
			uri: 'https://assgardians.000webhostapp.com/mcoc_db/info.php?c=' + champname,
			followAllRedirects: true,
			headers: { 'User-Agent': `Commando` },
			json: true
		});
        const status = getinfo.status;
        const nameClean = getinfo.name;
        const uppername = nameClean.toUpperCase();
        const img = getinfo.img;
        const nameclass = getinfo.heroclass_name;
        const colorname = getinfo.color;
        const class_icon = getinfo.heroclass_icon;

        const rep_larrow = response.replace(/\[l\]/g, "\u21E0");
        const rep_rarrow = rep_larrow.replace(/\[r\]/g, "\u21E2");
        const final = rep_rarrow.replace(/\[s\]/g, "\u2606 ");   

    // Arrows
        //left 
            //4-dash(⇠): 21E0    hook:21A9   white: 21E6    long: 27F5  long+cap: 27FB 
            //double-dash: 290C     triple-dash: 290E long-double(⟸): 27F8 open-head(⇽): 21FD
        //right 
            //4-dash: 21E2  hook: u21AA white: 21E8 long: 27F6  long+cap: 27FC 
            //double-dash: 290D triple-dash: 290F long-double: 27F9  open-head: 21FE
            //https://unicode-table.com/en/sets/stars-symbols/
    //stars
        //☆ = 2606  ✪  = 272A  ⍟ = 235F  ٭ = 066D
  if (status == 'success') {
        return msg.embed({
            description : '**Synergies for: ' + uppername + '**\n\n' + final,
            thumbnail: { url: img },
            color : colorname,
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

module.exports = SynCommand;
