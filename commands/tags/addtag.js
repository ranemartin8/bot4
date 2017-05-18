const commando = require('discord.js-commando');
const sql = require('sqlite');
sql.open('../../guildInfo.sqlite3');

class addTagCommand extends commando.Command {
    constructor(client) {
        super(client, {
            name: 'addtag',
            group: 'tags',
            memberName: 'addtag',
            description: 'Adds command tag to database',
            examples: ['addtag [tag name] [tag]'],
            args: [{
                    key: 'name',
                    prompt: 'What is the name of your tag?\n',
                    type: 'string'
                },
                {
                    key: 'tag',
                    prompt: 'What do you want your tag to say?\n',
                    type: 'string'
                }
            ],
            guildOnly: true
        })
    }
  //  hasPermission(msg) {
 //       return this.client.isOwner(msg.author) || msg.member.permissions.has('KICK_MEMBERS');
 //   }

    async run(message, args) {
        const { name, tag } = args
        let guildID = message.guild.id;
        let userName = '${message.author.tag}'
        let nameLower = name.toLowerCase()

        sql.get(`SELECT * FROM serverTags WHERE (guildId) = ${guildID} AND name = '${nameLower}'`).then(row => {
            if (!row) {
                sql.run('INSERT INTO serverTags (guildID, name, tag, user) VALUES (?, ?, ?, ?)', [guildID, nameLower, tag, userName]);
            } else {
                sql.run(`UPDATE serverTags SET tag = '${tag}', user = '${userName}' WHERE guildId = ${guildID} AND name = '${nameLower}'`)
            }
        }).catch(() => {
            console.error;
            sql.run('CREATE TABLE IF NOT EXISTS serverTags (guildID INTEGER, name TEXT, tag TEXT, user TEXT)').then(() => {
                sql.run('INSERT INTO serverTags (guildID, name, tag, user) VALUES (?, ?, ?, ?)', [guildID, nameLower, tag, userName])
            })
        })
        message.channel.send(':floppy_disk: Tag command saved! Hey, good for you!')
    }
}

module.exports = addTagCommand;