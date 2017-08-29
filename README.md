![xChat](http://i.imgur.com/oeWKfn3.jpg "xChat")

# xChat
Manage chat easily!

# Category
PocketMine-MP plugin

# Requirements
PocketMine-MP 3.0.0-ALPHA6

# Overview
**xChat**  lets you manage chat in a better way. Mute players, clear chat and more!

**Working with older versions of PocketMine-MP is not guaranteed**

**To prevent bugs delete old config file when updating plugin**

**Features**
- Mute/unmute players.
- Enable/disable chat.
- Clear chat.
- Block words.

# Commands
**/chat help [1/2]** - Available commnds

**/chat info** - Informations about plugin

**/chat reload** - Reload config file

**/chat clear** - Clear chat

**/chat enable** - Enable chat

**/chat disable** - Disable chat

**/chat mute [player]** - Mute player

**/chat unmute [player]** - Unmute player

**/chat unmuteall** - Unmute all muted players

**/chat muted** - Check list of muted players

**/chat add [word]** - Add word to list of banned words

**/chat remove [word]** - Remove word from list of banned words

**/chat words** - Check list of banned words

**Command aliases:** [c, xchat]

# Permissions
**xchat.*** - Allow to do everything

**xchat.info** - Allow to check informations about plugin

**xchat.help** - Allow to check plugin help page

**xchat.reload** - Allow to reload plugin configuration file

**xchat.clear** - Allow to clear chat

**xchat.enable** - Allow to enable chat

**xchat.disable** - Allow to disable chat

**xchat.mute** - Allow to mute specified player

**xchat.unmute** - Allow to umnute specified player

**xchat.unmuteall** - Allow to ummute all players

**xchat.muted** - Allow to check list of muted players

**xchat.add** - Allow to add word to list of banned words

**xchat.remove** - Allow to remove word from list of banned words

**xchat.words** - Allow to check list of banned words


# TO-DO
- Eliminate bugs

- More features


- Mute players for specified time

- Improve code

# Documentation
**Variables:**

{PLAYER} - **Show player nickname**

**bad-words: Use "kick" to kick player after detecting of bad words or "message" to warn player with message. (Without quotes)**

**Config file:**
```
---
version: 1.4
chat: enabled
bad-words: message
banned-word-message: "&cDo not use bad words!"
banned-word-kick: "/n&cDo not use bad words!"
clear-message: "&7Chat has been cleared by &e&l{PLAYER}"
clear-message-player: "&aYou have cleared the chat!"
enable-chat-message: "&aYou have enabled the chat!"
enable-chat-broadcast: "&7Chat has been enabled by &e&l{PLAYER}"
disable-chat-message: "&aYou have disabled the chat!"
disable-chat-broadcast: "&7Chat has been disabled by &e&l{PLAYER}"
chat-disabled-message: "&cChat is disabled!"
mute-message: "&e&l{PLAYER}&r&7 has been muted"
player-mute-message: "&7You have been muted by &e&l{PLAYER}"
unmute-message: "&e&l{PLAYER}&r&7 has been unmuted"
unmute-all-message: "&7All players have been unmuted!"
player-unmute-message: "&7You have been unmuted by &e&l{PLAYER}"
muted-player-message: "&cYou are muted!"
no-permission: "&cYou don't have permission to perform this command!"
...
```

# Download
[Here ya go](https://github.com/Rysieku/xChat/releases)
