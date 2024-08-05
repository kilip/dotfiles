if status is-interactive
    # Commands to run in interactive sessions can go here
end


if test -f /home/linuxbrew/.linuxbrew/bin/brew
  eval "/home/linuxbrew/.linuxbrew/bin/brew shellenv"
end
