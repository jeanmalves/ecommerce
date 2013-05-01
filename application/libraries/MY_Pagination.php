<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * My Pagination Class extended
 *
 * @category	Pagination
 * @author		Rafael Dantas
 */
class MY_Pagination extends CI_Pagination {
	
	var $base_page = 1;
	var $uri_segment_search = false;
	
	public function __construct($rules = array()) {
		parent::__construct($rules);
		
		$this->full_tag_open 	= '<div class="pagination">';
		$this->full_tag_close 	= '</div>';
		$this->cur_tag_open 	= '<span class="current">';
		$this->cur_tag_close 	= '</span>';
		$this->use_page_numbers = TRUE; 
		
		// Troca base_page para 0 se use_page_numbers for falso 
		if (!$this->use_page_numbers) {
			$this->base_page = 0;
		}
		
		if ($this->total_rows == 0 OR $this->per_page == 0) {
			$this->num_pages = 0;
		}
		else {
			$this->num_pages = ceil($this->total_rows / $this->per_page);
		}
		
		// Identifica p�gina atual
		$this->current_pagenumber();
	}
	
	/**
	 * Retorna um array com o limit e offset espec�fico para pagina��o
	 *
	 * @access	public
	 * @return	array - array(limit, offset)
	 */
	public function array_limoff() {
		
		return array( 
			'limit' => $this->per_page,
			'offset' => ($this->cur_page!=0) ? (($this->cur_page - 1) * $this->per_page) : 0 
		);		
	}
	
	/**
	 * Determina qual o n�mero da p�gina atual
	 * da pagina��o. Na verdade esta fun��o � bloco
	 * de c�digo que existia na create_links()
	 * que eu converti para fun��o pois preciso usar 
	 * em outros lugares
	 * 
	 * @access private
	 * @return void
	 */
	private function current_pagenumber() {
		
		$CI =& get_instance();

		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CI->input->get($this->query_string_segment) != $this->base_page)
			{
				$this->cur_page = $CI->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		else
		{
			if ($CI->uri->segment($this->uri_segment) != $this->base_page)
			{
				$this->cur_page = $CI->uri->segment($this->uri_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		
		// Set current page to 1 if using page numbers instead of offset
		if ($this->use_page_numbers AND $this->cur_page == 0)
		{
			$this->cur_page = $this->base_page;
		}
		
		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = $this->base_page;
		}
		
		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->use_page_numbers)
		{
			if ($this->cur_page > $this->num_pages)
			{
				$this->cur_page = $this->num_pages;
			}
		}
		else
		{
			if ($this->cur_page > $this->total_rows)
			{
				$this->cur_page = ($this->num_pages - 1) * $this->per_page;
			}
		}
		
	}
	
	/**
	 * Override na fun��o que gera os links de pagina��o
	 * para poder separar a cria��o dos links com a 
	 * determina��o da p�gina atual (cur_page)
	 * 
	 * Inclu�do tamb�m tratamento para busca
	 *
	 * @access	public
	 * @return	string
	 */
	function create_links() {
		
		$CI =& get_instance();
		
		// Se num_pages for 0 n�o precisa continuar, pois automaticamente ou total_rows
		// ou per_page ser� 0 tamb�m
		if ($this->num_pages == 0 OR $this->total_rows == 0 OR $this->per_page == 0)
		{
			return '';
		}

		// Calculate the total number of pages
		$this->num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($this->num_pages == 1)
		{
			return '';
		}
		
		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}		

		$uri_page_number = $this->cur_page;
		
		if ( ! $this->use_page_numbers)
		{
			$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
		}

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end   = (($this->cur_page + $this->num_links) < $this->num_pages) ? $this->cur_page + $this->num_links : $this->num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
		}
		else
		{
			$this->base_url = rtrim($this->base_url, '/') .'/';
		}
		
		// Se houver busca
		$search = '';
		if( $this->uri_segment_search ) {
			$search = $CI->uri->slash_segment( $this->uri_segment_search ); // retorna "segmento/"
			$search = ($search) ? $search : '';
		}

		// And here we go...
		$output = '';

		// Render the "First" link
		if  ($this->first_link !== FALSE AND $this->cur_page > ($this->num_links + 1))
		{
			$first_url = ($this->first_url == '') ? $this->base_url : $this->first_url;
			$output .= $this->first_tag_open.'<a '.$this->anchor_class.'href="'.$first_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;
		}

		// Render the "previous" link
		if  ($this->prev_link !== FALSE AND $this->cur_page != 1)
		{
			if ($this->use_page_numbers)
			{
				$i = $uri_page_number - 1;
			}
			else
			{
				$i = $uri_page_number - $this->per_page;
			}

			if ($i == 0 && $this->first_url != '')
			{
				$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}
			else
			{
				$i = ($i == 0) ? '' : $this->prefix.$i.$this->suffix;
				$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$search.$i.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}

		}

		// Render the pages
		if ($this->display_pages !== FALSE)
		{
			// Write the digit links
			for ($loop = $start -1; $loop <= $end; $loop++)
			{
				if ($this->use_page_numbers)
				{
					$i = $loop;
				}
				else
				{
					$i = ($loop * $this->per_page) - $this->per_page;
				}

				if ($i >= $this->base_page)
				{
					if ($this->cur_page == $loop)
					{
						$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
					}
					else
					{
						$n = ($i == $this->base_page) ? '' : $i;

						if ($n == '' && $this->first_url != '')
						{
							$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.'">'.$loop.'</a>'.$this->num_tag_close;
						}
						else
						{
							$n = ($n == '') ? '' : $this->prefix.$n.$this->suffix;

							$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$search.$n.'">'.$loop.'</a>'.$this->num_tag_close;
						}
					}
				}
			}
		}

		// Render the "next" link
		if ($this->next_link !== FALSE AND $this->cur_page < $this->num_pages)
		{
			if ($this->use_page_numbers)
			{
				$i = $this->cur_page + 1;
			}
			else
			{
				$i = ($this->cur_page * $this->per_page);
			}

			$output .= $this->next_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$search.$this->prefix.$i.$this->suffix.'">'.$this->next_link.'</a>'.$this->next_tag_close;
		}

		// Render the "Last" link
		if ($this->last_link !== FALSE AND ($this->cur_page + $this->num_links) < $this->num_pages)
		{
			if ($this->use_page_numbers)
			{
				$i = $this->num_pages;
			}
			else
			{
				$i = (($this->num_pages * $this->per_page) - $this->per_page);
			}
			$output .= $this->last_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$search.$this->prefix.$i.$this->suffix.'">'.$this->last_link.'</a>'.$this->last_tag_close;
		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;

		return $output;
	}
	
}