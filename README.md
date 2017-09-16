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
- Time mute players.
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

**/chat timemute [player] [time]** - Time mute player

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

**xchat.timemute** - Allow to time mute players

**xchat.unmute** - Allow to umnute specified player

**xchat.unmuteall** - Allow to ummute all players

**xchat.muted** - Allow to check list of muted players

**xchat.add** - Allow to add word to list of banned words

**xchat.remove** - Allow to remove word from list of banned words

**xchat.words** - Allow to check list of banned words

**xchat.***- Allow to do everything

# TO-DO
- Eliminate bugs

- Improve code

# Documentation
**Variables:**

{PLAYER} - **Show player nickname**
{TIME} - **Show for how many minutes player has been muted**

**bad-words: Use "kick" to kick player after detecting of bad words or "message" to warn player with message. (Without quotes)**

**Config file:**
```
---
version: 1.5
chat: enabled
bad-words: message
datetime-format: "Y/m/d H:i:s"
...
```

**Language file:**
```
#####################################################################
# Configure your messages in this file!                             #
# Available variables:                                              #
# - {PLAYER} - Display player nickname                              #
# - {TIME} - Display for how many minutes player has been muted     #
# - {HOUR} - Display current hour                                   #
# You can use colors by adding & before message. Example: &6hi!     #
#####################################################################

banned-word-message: "&cPlease do not use bad words!"

banned-word-kick: "/nYou are kicked!/n&cPlease do not use bad words!"

clear-broadcast: "&7Chat has been cleared by &e&l{PLAYER}"

clear-message-player: "&aYou have cleared the chat!"

enable-chat-message: "&aYou have enabled the chat!"

enable-chat-broadcast: "&7Chat has been enabled by &e&l{PLAYER}"

disable-chat-message: "&aYou have disabled the chat!"

disable-chat-broadcast: "&7Chat has been disabled by &e&l{PLAYER}"

chat-disabled: "&cChat is disabled!"

mute-message: "&e&l{PLAYER}&r&7 has been muted"

time-mute-message: "&e&l{PLAYER}&r&7 has been muted for &e&l{TIME}&r&7 minutes"

player-mute-message: "&7You have been muted by &e&l{PLAYER}"

player-time-mute: "&7You have been muted by &e&l{PLAYER}&r&7 for &e&l{TIME}&r&7 minutes"

unmute-message: "&e&l{PLAYER}&r&7 has been unmuted"

player-unmute-message: "&7You have been unmuted by &e&l{PLAYER}"

time-unmute-message: "&7Your mute has expired!"

unmute-all-message: "&7All players have been unmuted!"

player-muted: "&cYou can not use chat because you are muted!"

no-permission: "&cYou don't have permission to perform this command!"
```

# Download
**3.0.0-ALPHA6** - [CLICK](https://github.com/Rysieku/xChat/releases/tag/1.5alpha6)
**3.0.0-ALPHA7** - [CLICK](https://github.com/Rysieku/xChat/releases/tag/1.5alpha7)
