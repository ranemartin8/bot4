const commando = require('discord.js-commando');
const {
  stripIndents
} = require('common-tags');
const sql = require('sqlite');
sql.open('../../guildInfo.sqlite3');

class listCommand extends commando.Command {
  constructor(client) {
    super(client, {
      name: 'taglist',
      group: 'tags',
      memberName: 'taglist',
      description: 'List tag commands available',
      guildOnly: true,
      throttling: {
        usages: 2,
        duration: 5
      }
    });
  }
  async run(message) {
     let data = await sql.all(`SELECT name FROM serverTags WHERE guildID = ${message.member.guild.id}`)
     var result = data.map(a => a.name).join('\n ')

     if (!result) return message.channel.send(`${message.member.guild.name} does not currently have any tags.`)
     message.channel.send(`**Available Tag Commands:** (!t <command>)\n ${result}`)

  }
}

module.exports = listCommand;