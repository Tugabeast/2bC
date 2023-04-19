import React from 'react'

import * as AiIcons from 'react-icons/ai'
import * as BsIcons from 'react-icons/bs'

import '../styles/NavBar.css'


export const SidebarData = [
    {
        title: 'Home',
        path: '/',
        icon: <AiIcons.AiFillHome />,
        cName: 'nav-text'
    },
    {
        title: 'Graphics',
        path: '/reports',
        icon: <BsIcons.BsGraphDown />,
        cName: 'nav-text'
    },
    
]