if status is-interactive
    # Commands to run in interactive sessions can go here
end


if type -q /home/linuxbrew/.linuxbrew/bin/brew
  eval "/home/linuxbrew/.linuxbrew/bin/brew shellenv"
end
