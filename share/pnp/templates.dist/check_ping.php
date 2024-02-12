<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_icmp [Multigraph]

foreach ($this->DS as $KEY=>$VAL) {
    #
    # RTA
    #
    if($VAL['LABEL'] == 'rta') {
        $ds_name[1] = "Round Trip Times";
        $opt[1]  = "--vertical-label \"RTA\"  --title \"Ping times\" ";
        $def[1]  =  rrd::def("var1", $VAL['RRDFILE'], $VAL['DS'], "AVERAGE");
        $def[1] .=  rrd::gradient("var1", "ff5c00", "ffdc00", "Round Trip Times", 20) ;
        $def[1] .=  rrd::gprint("var1", array("LAST", "MAX", "AVERAGE"), "%6.2lf ".$VAL['UNIT']);
        $def[1] .=  rrd::line1("var1", "#000000") ;

        if($VAL['WARN'] != ""){
            if($VAL['UNIT'] == "%%"){ $VAL['UNIT'] = "%"; };
            $def[1] .= rrd::hrule($VAL['WARN'], "#FFFF00", "Warning  ".$VAL['WARN'].$VAL['UNIT']."\\n");
        }
        if($VAL['CRIT'] != ""){
            if($VAL['UNIT'] == "%%"){ $VAL['UNIT'] = "%"; };
            $def[1] .= rrd::hrule($VAL['CRIT'], "#FF0000", "Critical ".$VAL['CRIT'].$VAL['UNIT']."\\n");
        }
    }

    #
    # Packets Lost
    #
    if($VAL['LABEL'] == 'pl') {
        $ds_name[2] = "Packets Lost";
        $opt[2] = "--vertical-label \"Packets lost\" -l0 -u105 --title \"Packets lost\" ";

        $def[2]  =  rrd::def("var1", $VAL['RRDFILE'], $VAL['DS'], "AVERAGE");
        $def[2] .=  rrd::gradient("var1", "ff5c00", "ffdc00", "Packets Lost", 20);
        $def[2] .=  rrd::gprint("var1", array("LAST", "MAX", "AVERAGE"), "%3.0lf ".$VAL['UNIT']);
        $def[2] .=  rrd::line1("var1", "#000000") ;

        $def[2] .= rrd::hrule("100", "#000000") ;

        if($VAL['WARN'] != ""){
            if($VAL['UNIT'] == "%%"){ $VAL['UNIT'] = "%"; };
            $def[2] .= rrd::hrule($VAL['WARN'], "#FFFF00", "Warning  ".$VAL['WARN'].$VAL['UNIT']."\\n");
        }
        if($VAL['CRIT'] != ""){
            if($VAL['UNIT'] == "%%"){ $VAL['UNIT'] = "%"; };
            $def[2] .= rrd::hrule($VAL['CRIT'], "#FF0000", "Critical ".$VAL['CRIT'].$VAL['UNIT']."\\n");
        }
    }
}

?>
