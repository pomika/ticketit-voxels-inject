<?php

namespace Voxels\VoxelsInject;

use Closure;

class VoxelsInjectMiddleware
{
    protected $cssLinks = [
            "http://admin.voxels.io/css/right.dark.css",
            "http://admin.voxels.io/css/right.dark.custom.css"
    ];
    
    protected $jsCode = "document.domain = 'voxels.io';";
    
    protected $jsLinks = [];
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        if (!method_exists($response, 'content') or $request->ajax() or $request->isJson()) {
            return $response;
        }
        
        if (!$request->isJson() and !$request->ajax())
        {
            $dom = explode('</head>', $response->content());
            
            if (!empty($dom))
            {
                $dom[0] .= $this->addCSS() . $this->addJS() . '</head>';
                
                $response->setContent($dom[0] . $dom[1]);
            }
        }

        return $response;
    }

    public function addCSS($content = '')
    {
        foreach ($this->cssLinks as $cssLink) {
            $content .= "<link href='". $cssLink ."' rel='stylesheet'>\n";
        }
        
        return $content;
    }
    
    public function addJS($content = '')
    {
        $content .= "<script>". $this->jsCode ."</script>\n";
        
        if (!empty($this->jsLinks) && is_array($this->jsLinks))
        {
            foreach ($this->jsLinks as $jsLink) {
                $content .= "<script src='". $jsLink ."'>\n";
            }
        }
        
        return $content;
    }
}
