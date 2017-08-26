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
version: 1.3
chat: enabled
clear-message: "Chat has been cleared by {PLAYER}"
clear-message-player: "You have cleared the chat"
enable-chat-message: "You have enabled the chat"
enable-chat-broadcast: "Chat has been enabled by {PLAYER}"
disable-chat-message: "You have disabled the chat"
disable-chat-broadcast: "Chat has been disabled by {PLAYER}"
chat-disabled-message: "You can't chat! Chat is disabled!"
mute-message: "{PLAYER} has been muted"
player-mute-message: "You have been muted by {PLAYER}"
unmute-message: "{PLAYER} has been unmuted"
player-unmute-message: "You have been unmuted by {PLAYER}"
muted-player-message: "You are muted!"
no-permission: "You don't have permission to perform this command!"
...
```

# Download
[Here ya go](https://github.com/Rysieku/xChat/releases)
