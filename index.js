const commando = require('discord.js-commando');
const bot = new commando.Client({
    commandPrefix: '!',
    owner: '308388415064506369',
    disableEveryone: true,
    unknownCommandResponse: false
});

//.on('ready', () => {
 // console.log('I am ready!');
//});

//const guildSettings = require('./dataProviders/postgreSQL/models/GuildSettings');

bot
.on('error', console.error)
	.on('warn', console.warn)
	.on('debug', console.log)
	.on('ready', () => {
		console.log('Client ready');
	})
	.on('disconnect', () => { console.warn('Disconnected!'); })
	.on('reconnect', () => { console.warn('Reconnecting...'); })
	.on('commandError', (cmd, err) => {
		if(err instanceof commando.FriendlyError) return;
		console.error('Error in command ${cmd.groupID}:${cmd.memberName}', err);
	});

bot.registry.registerGroups([
	['champpi','Champ Information'],
	['tools','Alliance Tools'],
    ['content','MCOC Content']
   // ['config','Configuations']

	]);
bot.registry.registerDefaults();
bot.registry.registerCommandsIn(__dirname + "/commands");


bot.on('message',(message) =>{
  if (message.author.bot) return;
    
//	if(message.content == 'ping'){
//		message.channel.sendMessage('pong');
//	}
    
   // if (message.content.replace(/ /g, '') == '!getthis')

});

bot.login('MzA4Mzg4NDE1MDY0NTA2MzY5.C-gIpA.lgy8fQIepTrUu-BB7pz-zcJax7U');
