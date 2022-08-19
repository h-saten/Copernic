# General

Repository contains two piplines, first activated by push or PR to dev branch and second activated by the same action on main branch.

All changes have to be merged by pull request to dev branch, next pipeline is activated and send repo files by FTP to server which is accesible by url: https://copernic.io/dev

When all changes work well we can send pull request of dev branch to main and next files are deployed to main directory of server and accesible by url https://copernic.io 