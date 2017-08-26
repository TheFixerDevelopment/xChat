![xChat](http://i.imgur.com/oeWKfn3.jpg "xChat")

# xChat
Manage chat easily!

# Category
PocketMine-MP plugin

# Requirements
PocketMine-MP 3.0.0-ALPHA6

# Overview
**xChat**  lets you manage chat in better way. Mute players, clear chat and more!

**Working with older versions of PocketMine-MP is not guaranteed**

**To prevent bugs delete old config file when updating plugin**

**Features**
- Mute/unmute players.
- Enable/disable chat.
- Clear chat.

# Commands
**/chat help** - Available commnds

**/chat info** - Informations about plugin

**/chat reload** - Reload config file

**/chat clear** - Clear chat

**/chat enable** - Enable chat

**/chat disable** - Disable chat

**/chat mute [player]** - Mute player

**/chat unmute [player]** - Unmute player

**Command aliases:** [c, xchat]

# Permissions
**xchat.info** - Use /chat info command

**xchat.help** - Use /chat help command

**xchat.reload** - Use /chat reload command

**xchat.clear** - Use /chat clear command

**xchat.enable** - Use /chat enable command

**xchat.disable** - Use /chat disable command

**xchat.mute** - Use /chat mute command

**xchat.unmute** - Use /chat unmute command

**xchat.*** - Use every command

# TO-DO
- Change color of messages in config using &

- Eliminate known bugs

- More functions

- Improve mute

- Mute players for specified time

# Documentation
**Variables:**

{PLAYER} - **Show player nickname**

**Config file:**
```
---
version: 1.3.1
chat: enabled
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
player-unmute-message: "&7You have been unmuted by &e&l{PLAYER}"
muted-player-message: "&cYou are muted!"
no-permission: "&cYou don't have permission to perform this command!"
...
```

# Download
[Here ya go](https://github.com/Rysieku/xChat/releases)
