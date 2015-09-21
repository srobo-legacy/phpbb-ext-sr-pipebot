# pipebot-phpbb
SR Pipebot wrapper for phpBB

This is a phpBB 3.1 compatible extension which adds support for emitting
messages about the forum posts to an IRC channel via a pipe on the host.

Specifically it uses Student Robotics' [pipebot](https://www.studentrobotics.org/cgit/pipebot.git)
to emit the messages into the pipe and assumes that something will be listening.

## Installation

The extension can be installed by cloning into the `ext/sr/pipebot` folder
of a phpBB installation. Note that the `sr` layer won't exist and will need
creating manually.
