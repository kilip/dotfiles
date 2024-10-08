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

set -gx PATH "/home/toni/.local/bin" $PATH
set -gx PATH "/home/toni/apps/flutter/bin" $PATH
set -gx PATH "/home/toni/apps/android-studio/bin" $PATH

#if test -f /home/toni/.deno/bin/deno
#  set -gx DENO_INSTALL "/home/toni/.deno"
#  set -gx PATH "/home/toni/.deno/bin" $PATH
#end

# pnpm
set -gx PNPM_HOME "/home/toni/.local/share/pnpm"
if not string match -q -- $PNPM_HOME $PATH
  set -gx PATH "$PNPM_HOME" $PATH
end
# pnpm end
