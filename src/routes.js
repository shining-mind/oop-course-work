
// Components
import Home from './pages/Home.svelte'
import NotFound from './pages/NotFound.svelte'

const routes = {
    // Exact path
    '/': Home,
    // Catch-all, must be last
    '*': NotFound,
}

export default routes