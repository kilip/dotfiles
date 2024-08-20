if status is-interactive
    # Commands to run in interactive sessions can go here
end


if test -f /home/linuxbrew/.linuxbrew/bin/brew
  eval (/home/linuxbrew/.linuxbrew/bin/brew shellenv)

  if test -d (brew --prefix)"/share/fish/completions"
    set -p fish_complete_path (brew --prefix)/share/fish/completions
  end

  if test -d (brew --prefix)"/share/fish/vendor_completions.d"
    set -p fish_complete_path (brew --prefix)/share/fish/vendor_completions.d
  end
end

set -gx DENO_INSTALL "/home/toni/.deno"
set -gx PATH "/home/toni/.local/bin" $PATH
set -gx PATH "/home/toni/.deno/bin" $PATH
